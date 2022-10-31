<?php

namespace Migration;

use Cycle\Migrations\Migration;

class Migration1667215758655989 extends Migration
{
    protected const DATABASE = 'primary';

    public function up(): void
    {
        $this->table('symfony_demo_user')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('full_name', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('username', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('email', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('password', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('roles', 'json', [
                'nullable' => false,
                'default'  => null
            ])
            ->setPrimaryKeys(["id"])
            ->create();
        
        $this->table('symfony_demo_post')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('title', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('slug', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('summary', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->addColumn('content', 'text', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('published_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('author_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addIndex(["author_id"], [
                'name'   => 'symfony_demo_post_index_author_id_635fb18e902f4',
                'unique' => false
            ])
            ->addForeignKey(["author_id"], 'symfony_demo_user', ["id"], [
                'name'   => 'symfony_demo_post_foreign_author_id_635fb18e90382',
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->setPrimaryKeys(["id"])
            ->create();
        
        $this->table('symfony_demo_comment')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('content', 'text', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('published_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('post_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('author_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addIndex(["post_id"], [
                'name'   => 'symfony_demo_comment_index_post_id_635fb18e90595',
                'unique' => false
            ])
            ->addIndex(["author_id"], [
                'name'   => 'symfony_demo_comment_index_author_id_635fb18e90788',
                'unique' => false
            ])
            ->addForeignKey(["post_id"], 'symfony_demo_post', ["id"], [
                'name'   => 'symfony_demo_comment_foreign_post_id_635fb18e905aa',
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->addForeignKey(["author_id"], 'symfony_demo_user', ["id"], [
                'name'   => 'symfony_demo_comment_foreign_author_id_635fb18e9079a',
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->setPrimaryKeys(["id"])
            ->create();
        
        $this->table('symfony_demo_tag')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('name', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->setPrimaryKeys(["id"])
            ->create();
        
        $this->table('symfony_post_tag')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('post_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('tag_id', 'integer', [
                'nullable' => false,
                'default'  => null
            ])
            ->addIndex(["post_id", "tag_id"], [
                'name'   => 'symfony_post_tag_index_post_id_tag_id_635fb18e9066b',
                'unique' => true
            ])
            ->addIndex(["post_id"], [
                'name'   => 'symfony_post_tag_index_post_id_635fb18e9068e',
                'unique' => false
            ])
            ->addIndex(["tag_id"], [
                'name'   => 'symfony_post_tag_index_tag_id_635fb18e906b3',
                'unique' => false
            ])
            ->addForeignKey(["post_id"], 'symfony_demo_post', ["id"], [
                'name'   => 'symfony_post_tag_foreign_post_id_635fb18e90683',
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->addForeignKey(["tag_id"], 'symfony_demo_tag', ["id"], [
                'name'   => 'symfony_post_tag_foreign_tag_id_635fb18e906a7',
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->setPrimaryKeys(["id"])
            ->create();
    }

    public function down(): void
    {
        $this->table('symfony_post_tag')->drop();
        
        $this->table('symfony_demo_tag')->drop();
        
        $this->table('symfony_demo_comment')->drop();
        
        $this->table('symfony_demo_post')->drop();
        
        $this->table('symfony_demo_user')->drop();
    }
}
