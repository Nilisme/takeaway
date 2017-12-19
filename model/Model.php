<?php
import('db/Db');
import('validator/Validator');

class Model extends Db
{
  public $filled = [];

  public $validator;
  public $rule;

  public function __construct()
  {
    parent::__construct($this->table);
    $this->validator = new Validator($this->table);
  }

  public function fill($row)
  {
    $this->filled = $row;
  }

  public function safe_fill($row)
  {
    $filtered = [];

    foreach ($this->all_column_name() as $col) {
      $val = @$row[$col];
      if (! $val) 
        continue;
      $filtered[$col] = $val;
    }

    $this->fill($filtered);
    return $this;
  }

  public function validate_filled(&$msg){
    foreach ($this->filled as $col => $val) {
      $is_valid = $this->validator->validate_rules($val,@$this->rule[$col], $validator_msg);
      if (!$is_valid) {
        $msg[$col] = $validator_msg;
        return false;
      }
    }
    return true;
  }

  public function save(&$msg = [])
  {
    $filled = &$this->filled;

    $valid = $this->validate_filled($msg);
    if ( ! $valid)
      return false;

    $is_update = (bool) $id = @$filled['id'];

    if ($is_update) {
      $this->where('id', $id);

      if (! $this->get()) {
        $msg[id] = 'not_exist';
        return false;
      }
      // dd($filled);
      $this->where('id', $filled['id']);
      return $this->update($filled);
    } else {
      if ($this->insert($filled)) {
        return $this->last_id();
      }
      return false;
    }
  }

}