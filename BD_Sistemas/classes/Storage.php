<?php
class Storage {
    private $file;
    public function __construct(string $filePath) {
        $this->file = $filePath;
        $dir = dirname($this->file);
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        if (!file_exists($this->file)) file_put_contents($this->file, json_encode([]));
    }
    public function all(): array {
        $json = @file_get_contents($this->file);
        return $json ? json_decode($json, true) : [];
    }
    public function save(array $item): array {
        $list = $this->all();
        $item['id'] = count($list) + 1;
        $list[] = $item;
        file_put_contents($this->file, json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $item;
    }
}
