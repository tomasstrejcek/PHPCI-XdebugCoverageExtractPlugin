<?php
/**
 * Created by PhpStorm.
 * User: magerio
 * Date: 21.1.2015
 * Time: 0:36
 */

namespace ECH\PhpCIPlugins;

use PHPCI\Helper\Lang;
use PHPCI\Plugin;


use PHPCI\Builder;
use PHPCI\Model\Build;
use Psr\Log\LogLevel;

class XdebugCoverageExtractPlugin implements Plugin {
    private $args;
    private $config;
    private $directory;
    /**
     * Set up the plugin, configure options, etc.
     * @param Builder $phpci
     * @param Build $build
     * @param array $options
     */
    public function __construct(Builder $phpci, Build $build, array $options = array())
    {
        $this->phpci = $phpci;
        $this->build = $build;

        if (isset($options['path'])) {
            $this->path = $options['path'];
        }

    }
    /**
     * Run the Atoum plugin.
     * @return bool
     */
    public function execute()
    {
        chdir($this->phpci->buildPath);
        if(file_exists($this->path)) {
            $file = file_get_contents($this->path);
            $content = preg_match('<h1>[^<>]*</h1>', $file);
            $this->phpci->log(str_replace('&nbsp;', '', $content));
        }

        return true;
    }

}
