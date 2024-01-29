<?php

use yii\db\Migration;

/**
 * Class m230815_113042_init_rbac
 */
class m230815_113042_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Добавляем разрешение "createBook"
       $auth = Yii::$app->authManager;
         $createBook = $auth->createPermission('createBook');
            $createBook->description = 'Create a book';
            $auth->add($createBook);

        // Добавляем разрешение "viewBook"

        $viewBook = $auth->createPermission('viewBook');
            $viewBook->description = 'View a book';
            $auth->add($viewBook);

        // Добавляем разрешение "updateBook"

        $updateBook = $auth->createPermission('updateBook');
            $updateBook->description = 'Update book';
            $auth->add($updateBook);
            
        // Добавляем разрешение "updateOwnBook" и привязываем к нему правило.

        $updateOwnBook = $auth->createPermission('updateOwnBook');
            $updateOwnBook->description = 'Update own book';
            $updateOwnBook->ruleName = $rule->name;
            $auth->add($updateOwnBook);
            
        // Добавляем разрешение "deleteBook"

        $deleteBook = $auth->createPermission('deleteBook');
            $deleteBook->description = 'Delete book';
            $auth->add($deleteBook);

        // Добавляем роль "Каталогизатор" и даём роли разрешение "createBook" и "updateBook"

        $cataloguer = $auth->createRole('cataloguer');
            $auth->add($cataloguer);
            $auth->addChild($cataloguer, $createBook);
            $auth->addChild($cataloguer, $updateOwnBook);

        // Добавляем роль "Библиотекарь" и даём роли разрешение "viewBook"

        $librarian = $auth->createRole('librarian');
            $auth->add($librarian);
            $auth->addChild($librarian, $viewBook);


        // Добавляем роль "Администратор" и даём роли разрешение включающее в себя все разрешения

        $admin = $auth->createRole('admin');
            $auth->add($admin);
            $auth->addChild($admin, $updateBook);
            $auth->addChild($admin, $librarian);
            $auth->addChild($admin, $deleteBook);


        // Назначаем роль "Администратор" пользователю с ID 1

        $auth->assign($admin, 1);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230815_113042_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
