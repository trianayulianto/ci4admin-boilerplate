<?php namespace Irsyadulibad\DataTables;

use Irsyadulibad\DataTables\Utilities\Request;

class DataProcessor
{
	protected $processColumn;

	protected $result;

	protected $results;

	public function __construct($result, $process)
	{
		$this->result = $result;
		$this->results = $result->getResultArray();
		$this->processColumn = $process;
	}

	public function process()
	{
		if(!empty($this->processColumn['appends']))
			$this->addColumns();

		if($this->processColumn['index'])
			$this->addIndexColumn();

		if(!empty($this->processColumn['edit']))
			$this->editColumns();

		if(!empty($this->processColumn['hidden']))
			$this->hide();

		$this->escapeColumns();

		return $this->results;
	}

	public function addColumns()
	{
		$result = $this->result->getResult();
		$appendCols = $this->processColumn['appends'];
		$i = 0;

		foreach($this->results as $data) {

			foreach($appendCols as $append) {
				$name = $append['name'];
				$callback = $append['callback'];

				$this->results[$i][$name] = $callback($result[$i]);
			}

			$i++;
		}
	}

	public function addIndexColumn()
	{
		$request = Request::staticInstance()->getLimiting();
		
		foreach($this->results as $i => $data) {
			$this->results[$i]['index'] = $i + $request['offset'] + 1;
		}
	}

	public function editColumns()
	{
		$editCols = $this->processColumn['edit'];
		$i = 0;

		foreach($this->results as $data) {

			foreach($editCols as $edit) {
				$name = $edit['name'];
				$callback = $edit['callback'];
				$result = $this->results[$i][$name];

				$this->results[$i][$name] = $callback($result);
			}

			$i++;
		}
	}

	public function hide()
	{

		$hideCols = $this->processColumn['hidden'];
		$i = 0;

		foreach ($this->results as $data) {
			foreach($data as $key => $val) {
				// Check if hide columns exist
				if(in_array($key, $hideCols)) {
					unset($this->results[$i][$key]);
				}

				continue;
			}

			$i++;
		}
	}

	public function escapeColumns()
	{
		$rawCols = $this->processColumn['raws'];
		$i = 0;

		foreach ($this->results as $data) {
			foreach($data as $key => $val) {
				// Check if raw columns exist
				if(in_array($key, $rawCols)) 
					continue;

				$this->results[$i][$key] = esc($val);
			}

			$i++;
		}
	}
}
