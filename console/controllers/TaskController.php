<?php

namespace console\controllers;

use common\models\enum\TaskStatus;
use common\models\Task;
use yii\console\Controller;

final class TaskController extends Controller
{
    public function actionUpdateStatus()
    {
        Task::updateAll(
            ['status' => TaskStatus::Expired->value],
            [
                'AND',
                ['<=', 'due_date', time()],
                ['!=', 'status', TaskStatus::Expired->value]
            ]
        );
    }
}
