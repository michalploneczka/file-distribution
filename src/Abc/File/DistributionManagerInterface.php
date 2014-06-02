<?php
namespace Abc\File;

interface DistributionManagerInterface
{

    /**
     * Distributes file A to file B
     *
     * @param FileInterface $sourceFile
     * @param FileInterface $targetFile
     * @param boolean       $overwrite
     * @return
     */
    public function copyFile(FileInterface $sourceFile, FileInterface $targetFile, $overwrite);


    /**
     * Distributes file to a location
     *
     * @param FileInterface     $file
     * @param LocationInterface $location
     * @return FileInterface
     */
    public function distribute(FileInterface $file, LocationInterface $location);


    /**
     * Creates new file
     *
     * @param LocationInterface $location
     * @return FileInterface
     */
    public function createFile(LocationInterface $location);
} 