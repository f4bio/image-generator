<?php
namespace Salopot\ImageGenerator;

class ImageManager extends \Intervention\Image\ImageManager
{
    public const DRIVER_GD = 'gd';
    public const DRIVER_IMAGICK = 'imagick';

    /** @var string[] */
    protected $supportedExtensions;

    public function __construct(array $config = [])
    {
        if (isset($config['driver']) &&  $config['driver'] === 'auto') {
            $config['driver'] = extension_loaded('imagick') ? 'imagick': 'gd';
        }
        parent::__construct($config);

        $this->supportedExtensions = [
            'jpg', 'jpeg', 'jpe',
            'png',
            'gif',
        ];
        if ($this->config['driver'] === 'imagick') {
            $this->supportedExtensions = array_merge($this->supportedExtensions, [
                'bmp',
                'tif', 'tiff',
                'ico',
            ]);
        }
    }

    /**
     * Return array of supported extensions
     * @return array
     */
    public function getSupportedExtensions(): array
    {
        return $this->supportedExtensions;
    }

    /**
     * Return used image driver
     * @return string
     */
    public function getDriver(): string
    {
        return $this->config['driver'];
    }
}
