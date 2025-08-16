<?php

namespace Irsyadulibad\DataTables;

use CodeIgniter\Format\JSONFormatter;

abstract class DataTableMethods
{
    public $builder;

    public $request;

    protected $tables = [];

    protected $fields = [];

    protected $aliases = [];

    protected $totalRecords;

    protected $filteredRecords;

    protected $isFilterApplied = false;

    protected $processColumn = [
        'appends' => [],
        'hidden' => [],
        'index' => false,
        'raws' => [],
        'edit' => [],
    ];

    public function select(string $fields)
    {
        $this->builder->select($fields);

        $this->setAliases($fields);

        return $this;
    }

    public function where(array $data)
    {
        $this->builder->where($data);

        return $this;
    }

    public function orWhere(array $data)
    {
        $this->builder->orWhere($data);

        return $this;
    }

    public function join($table, $cond, $type = '')
    {
        $this->addTable($table);
        $this->builder->join($table, $cond, $type);

        return $this;
    }

    public function filter(callable $callback)
    {
        $callback($this->builder);

        return $this;
    }

    public function hideColumns(array $cols)
    {
        $this->processColumn['hidden'] = $cols;

        return $this;
    }

    public function rawColumns(array $cols)
    {
        $this->processColumn['raws'] = $cols;

        return $this;
    }

    public function addColumn(string $name, $callback)
    {
        $this->processColumn['appends'][] = [
            'name' => $name,
            'callback' => $callback,
        ];

        return $this;
    }

    public function addIndexColumn()
    {
        $this->processColumn['index'] = true;

        return $this;
    }

    public function editColumn(string $name, $callback)
    {
        $this->processColumn['edit'][] = [
            'name' => $name,
            'callback' => $callback,
        ];

        return $this;
    }

    protected function render($results, $make)
    {
        $formatter = new JSONFormatter;

        $output = [
            'draw' => $this->request->getDraw(),
            'recordsTotal' => $this->totalRecords,
            'recordsFiltered' => $this->filteredRecords,
            'data' => $results,
        ];
        if ($make) {
            return $formatter->format($output);
        }

        return d($output);
    }

    protected function filterRecords()
    {
        $this->filteredRecords = $this->isFilterApplied ? $this->count() : $this->totalRecords;
    }

    private function setAliases($fields)
    {
        foreach (explode(',', (string) $fields) as $val) {
            if (stripos($val, 'as')) {
                $alias = trim((string) preg_replace('/(.*)\s+as\s+(\w*)/i', '$2', $val));
                $field = trim((string) preg_replace('/(.*)\s+as\s+(\w*)/i', '$1', $val));

                $this->aliases[$alias] = $field;
            }
        }

        return true;
    }

    private function addTable($table)
    {
        if (stripos((string) $table, 'as')) {
            $table = trim((string) preg_replace('/(.*)\s+as\s+(\w*)/i', '$1', (string) $table));
        }

        $this->tables[] = $table;
    }
}
