<?php

namespace common\models;

use common\models\enum\TaskStatus;
use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $due_date
 * @property int $status
 * @property int $priority
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'due_date'], 'required'],
            [['description'], 'string'],
            [['due_date', 'priority'], 'integer'],
            ['status', 'in', 'range' => array_keys(TaskStatus::getStatuses())],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'due_date' => 'Due Date',
            'status' => 'Status',
            'priority' => 'Priority',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find(): TaskQuery
    {
        return new TaskQuery(get_called_class());
    }

    public function getStatusName(): string
    {
        return TaskStatus::getStatuses()[$this->status];
    }

    public function isExpired(): bool
    {
        return $this->status === TaskStatus::Expired->value;
    }
}
