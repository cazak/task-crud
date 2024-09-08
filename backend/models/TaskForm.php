<?php

namespace backend\models;

use common\models\enum\TaskStatus;
use common\models\Task;
use yii\base\Model;

class TaskForm extends Model
{
    public string $title = '';
    public string $description = '';
    public int $status = 0;
    public int $priority = 0;
    public string $dueDate = '';

    private Task $task;

    public function __construct(Task $task = null, $config = [])
    {
        parent::__construct($config);

        if ($task) {
            $this->task = $task;

            $this->title = $task->title;
            $this->description = $task->description;
            $this->status = $task->status;
            $this->priority = $task->priority;
            $this->dueDate = date('d-m-Y', $task->due_date);
        } else {
            $this->task = new Task();
        }
    }

    public function rules()
    {
        return [
            [['title', 'dueDate'], 'required'],
            [['description'], 'string'],
            [['priority'], 'integer'],
            ['status', 'in', 'range' => array_keys(TaskStatus::getStatuses())],
            ['dueDate', 'date', 'format' => 'php:d-m-Y'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $this->task->setAttributes([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => strtotime($this->dueDate),
        ], false);

        $this->task->save(false);

        return true;
    }

    public function getTask(): Task
    {
        return $this->task;
    }
}
