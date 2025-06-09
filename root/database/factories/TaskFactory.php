<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $taskTitles = [
            'プロジェクトの環境構築（ローカル・Dockerなど）',
            'Gitリポジトリ作成と初期設定',
            'Laravelプロジェクトのセットアップ',
            'Vue.jsとInertia.jsの導入',
            'ユーザー認証機能の実装（登録・ログイン・ログアウト）',
            'ユーザープロフィール編集画面の作成',
            'タスクモデルとマイグレーションの作成',
            'タスク一覧画面の作成（Vueコンポーネント）',
            'タスク作成・編集・削除機能の実装',
            'タスクのステータス管理（pending, in_progress, done）の実装',
            'タスクの優先度設定（low, medium, high）の実装',
            'タスクの期限設定機能追加（due_date）',
            'タスクフィルター機能の実装（状態・優先度・期限など）',
            'タスク検索機能の実装',
            'タスクの担当者割り当て機能実装',
            'ページネーションの導入（タスク一覧）',
            '日本語化対応（言語ファイル設定）',
            'APIの実装（必要に応じて）',
            'バリデーションルールの実装（サーバー・クライアント両方）',
            '単体テスト・統合テストの作成と実行',
        ];

        $taskDescription = [
            '開発用PCに必要なツールをインストールし、動作確認できる状態にする。Docker環境のセットアップも含む。',
            'GitHubなどのリポジトリ作成、.gitignore設定、初期コミットまで行う。',
            'Laravelのインストール、基本的な設定、初期画面表示確認まで行う。',
            'フロントエンドにVue.jsとInertia.jsを組み込み、Laravelと連携できるように設定する。',
            'ユーザーが登録、ログイン、ログアウトできるように認証機能を構築。',
            'ユーザー情報を閲覧・編集できる画面を作成し、更新機能を実装する。',
            'タスク管理のためのDBテーブル設計・作成と、それに対応するモデルを用意する。',
            '登録されたタスクを一覧で表示するフロント画面を作成する。',
            'タスクの新規登録、編集、削除をできるように機能を追加。',
            'タスク状態を管理し、ステータス変更が可能なUI・ロジックを作成する。',
            'タスクの重要度を設定できるようにし、一覧で視覚的に判別できるようにする。',
            'タスクごとに期限を設定でき、期限切れを判別できる仕組みを作る。',
            '状態や優先度、期限などでタスクを絞り込む機能を実装。',
            'タスク名や内容から検索できる機能を追加する。',
            'タスクに担当ユーザーを割り当て、誰が担当しているか管理できるようにする。',
            'タスク一覧が多くなった場合にページ分割し、負荷軽減と見やすさを向上させる。',
            'アプリ全体を日本語対応にし、利用者にとって使いやすいUIにする。',
            '外部連携やフロントAPI用のルーティング・コントローラーを作成。',
            '入力値の検証をサーバーとフロント両方で実装し、不正入力を防止する。',
            '主要機能のテストコードを作成し、自動テストを実施できるようにする。',
        ];

        $taskStatus = ['pending', 'in_progress', 'done'];
        $taskPriority = ['low', 'medium', 'high'];

        $taskIndex = rand(0, 19);

        return [
            'title' => $taskTitles[$taskIndex],
            'description' => $taskDescription[$taskIndex],
            'status' => $this->faker->randomElement($taskStatus),
            'priority' => $this->faker->randomElement($taskPriority),
            'due_date' => optional($this->faker->optional()->dateTimeBetween('now', '+1 month'))->format('Y/m/d'),
        ];
    }
}
