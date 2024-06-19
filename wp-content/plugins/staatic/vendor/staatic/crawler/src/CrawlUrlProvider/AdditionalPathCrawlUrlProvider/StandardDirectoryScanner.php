<?php

namespace Staatic\Crawler\CrawlUrlProvider\AdditionalPathCrawlUrlProvider;

use DirectoryIterator;
use RecursiveCallbackFilterIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
final class StandardDirectoryScanner implements DirectoryScannerInterface
{
    /**
     * @var mixed[]
     */
    private $excludePaths;
    public function __construct(array $excludePaths = [])
    {
        $this->setExcludePaths($excludePaths);
    }
    public function excludePaths() : array
    {
        return $this->excludePaths;
    }
    /**
     * @param mixed[] $excludePaths
     */
    public function setExcludePaths($excludePaths) : void
    {
        $this->excludePaths = [];
        foreach ($excludePaths as $path) {
            $normalizedPath = $this->normalizePath($path);
            $this->excludePaths[] = $normalizedPath;
            if (($resolvedPath = \realpath($normalizedPath)) && $normalizedPath !== $resolvedPath) {
                $this->excludePaths[] = $resolvedPath;
            }
        }
    }
    private function normalizePath(string $path) : string
    {
        if (\DIRECTORY_SEPARATOR === '\\') {
            $path = \str_replace('\\', '/', $path);
        }
        if (\substr($path, 1, 1) === ':') {
            $path = \ucfirst($path);
        }
        return \rtrim($path, '/\\');
    }
    /**
     * @param string $directory
     * @param bool $recursive
     */
    public function scan($directory, $recursive = \true) : iterable
    {
        if ($recursive) {
            return $this->scanRecursive($directory);
        } else {
            return $this->scanNonRecursive($directory);
        }
    }
    private function scanRecursive(string $directory) : iterable
    {
        $flags = RecursiveDirectoryIterator::SKIP_DOTS | RecursiveDirectoryIterator::FOLLOW_SYMLINKS;
        $iterator = new RecursiveIteratorIterator(new RecursiveCallbackFilterIterator(new RecursiveDirectoryIterator($directory, $flags), function ($fileInfo, $path, $iterator) {
            return !$this->shouldExcludePath($path);
        }));
        foreach ($iterator as $fileInfo) {
            (yield $fileInfo->getPathname());
        }
    }
    private function scanNonRecursive(string $directory) : iterable
    {
        $iterator = new DirectoryIterator($directory);
        foreach ($iterator as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }
            $path = $fileInfo->getPathname();
            if ($this->shouldExcludePath($path)) {
                continue;
            }
            (yield $fileInfo->getPathname());
        }
    }
    private function shouldExcludePath(string $path) : bool
    {
        if (strncmp(\basename($path), '.', strlen('.')) === 0) {
            return \true;
        }
        return \in_array($this->normalizePath($path), $this->excludePaths);
    }
}
