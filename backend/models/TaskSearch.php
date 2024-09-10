<?php

namespace backend\models;

use yii\base\Model;
use common\models\Task;
use yii\data\ArrayDataProvider;

/**
 * TaskSearch represents the model behind the search form of `common\models\Task`.
 */
final class TaskSearch extends Task
{
    private const string CACHE_NAME = 'tasks_index_cache';
    private const int CACHE_DURATION = 3600;

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     */
    public function search($params): ArrayDataProvider
    {
        $this->load($params);

        $models = \Yii::$app->cache->get(self::CACHE_NAME);

        if ($models === false) {
            $models = Task::find()->all();

            \Yii::$app->cache->set(self::CACHE_NAME, $models, self::CACHE_DURATION);
        }

        return new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => ['title'],
                'defaultOrder' => [
                    'title' => SORT_ASC,
                ],
            ],
        ]);
    }
}
