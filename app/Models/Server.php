<?php

namespace App\Models;


class Server
{
    public $table = 'servers';

    private $id;
    private $name;
    private $ip_address;
    private $status;
    private $cpu_usage;
    private $memory_usage;
    private $last_checked;
    private $is_monitored;
    private $created_at;
    private $updated_at;
    private $deleted_at;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getIpAddress() {
        return $this->ip_address;
    }

    public function setIpAddress($ip_address) {
        $this->ip_address = $ip_address;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getCpuUsage() {
        return $this->cpu_usage;
    }

    public function setCpuUsage($cpu_usage) {
        $this->cpu_usage = $cpu_usage;
    }

    public function getMemoryUsage() {
        return $this->memory_usage;
    }

    public function setMemoryUsage($memory_usage) {
        $this->memory_usage = $memory_usage;
    }

    public function getLastChecked() {
        return $this->last_checked;
    }

    public function setLastChecked($last_checked) {
        $this->last_checked = $last_checked;
    }

    public function getIsMonitored() {
        return $this->is_monitored;
    }

    public function setIsMonitored($is_monitored) {
        $this->is_monitored = $is_monitored;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function getDeletedAt() {
        return $this->deleted_at;
    }

    public function setDeletedAt($deleted_at) {
        $this->deleted_at = $deleted_at;
    }

}