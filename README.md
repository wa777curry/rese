# Rese（リーズ）　- 飲食店予約サービス

![A6D637ED-7556-4866-972E-B4A8218E3BBC](https://github.com/wa777curry/rese/assets/136479019/c0f8bc0b-5231-427b-9396-6f58a2375ee2)

## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい

## ユーザーテストURL：http://localhost/
<details>

* テストアカウント：test@testmail  
* テストパスワード：password
</details>

## 管理者テストURL：http://localhost/admin/login/
<details>

* 管理者テストアカウント：admin@testmail  
* 管理者テストパスワード：password  
* 店舗代表者テストアカウント：sushi@testmail  
* 店舗代表者テストパスワード：password
</details>

## 機能一覧
* 会員登録
* 店舗検索
* 予約の登録, 変更, 削除, 評価機能

## 使用技術
* HTML, CSS, JavaScript
* PHP 8.2.8, Laravel 8.83.27
* MySQL 8.0.26
* Docker, Docker Compose

## テーブル設計
<details>

![table](https://github.com/wa777curry/rese/assets/136479019/5c2f31e1-a4e7-493d-8bb0-226940457425)
</details>

## ER図
<details>

![er drawio](https://github.com/wa777curry/rese/assets/136479019/debecf65-e239-45e5-9593-e8a4d27ab12f)
</details>

## 環境構築
### 事前準備
<details>

* Githubのインストール  
   > 参考サイト：https://kinsta.com/jp/knowledgebase/install-git/
* Dockerのインストール  
   > 参考サイト（Mac)：https://matsuand.github.io/docs.docker.jp.onthefly/desktop/mac/install/  
   > 参考サイト（Win)：https://matsuand.github.io/docs.docker.jp.onthefly/desktop/windows/install/
</details>

### 導入手順
<details>

1. リモートリポジトリからローカルリポジトリにクローンする  
   * 自分のローカルリポジトリにクローンする  
   ```shell
   mkdir {任意の名前}
   cd {上記で作ったディレクトリ}
   git clone git@github.com:wa777curry/rese.git
   ```

1. 自分のリモートリポジトリにローカルリポジトリのデータを反映させる  
（開発環境がいらないときはこの工程は不要）
   * 自分のGithubに任意の名前でリモートリポジトリを作成する
   * ローカルリポジトリとリモートリポジトリを紐づける
   ```shell
   cd クローンされたフォルダ
   git remote set-url origin {作成したリポジトリのURL(git@github.com:〜)}
   git remote -v
   ```
   * ローカルで変更したものをコミットする
   ```shell
   git add .
   git commit -m "任意のコミットメッセージ"
   ```
   * リモートに変更を反映させる
   ```shell
   git push
   ```

1. .envファイルの作成と修正  
   * .env.exampleをコピーして、.envファイルを作成します
   ```shell
   cd src
   cp .env.example .env
   ```
   * .envファイルを以下のように修正します
   ```diff shell
   open .env
   DB_CONNECTION=mysql
   - DB_HOST=127.0.0.1
   + DB_HOST=mysql
   DB_PORT=3306
   - DB_DATABASE=laravel
   - DB_USERNAME=root
   - DB_PASSWORD=
   + DB_DATABASE=laravel_db
   + DB_USERNAME=laravel_user
   + DB_PASSWORD=laravel_pass
   ```

2. Dockerの設定  
   ```shell
   docker-compose up -d --build
   ```
   * Dockerにコンテナが作成されていれば成功です  

3. Laravelのパッケージのインストール  
   * PHPコンテナ内へのログイン
   ```shell
   docker-compose exec php bash
   ```
   * ログインできたらパッケージをインストール
   ```php
   composer install
   ```

4. APP_KEYの作成  
   * PHPコンテナ内で以下のコマンドを実行
   ```php
   php artisan key:generate
   ```

4. データベースのマイグレーション
   * PHPコンテナ内でマイグレーションを実行
    ```php
    php artisan migrate:fresh
    ```

6. シーディングの実行
  * 以下のテストデータが含まれています
     * 管理者情報
     * 店舗代表者情報
     * ユーザー情報
     * エリア情報
     * ジャンル情報
     * 予約情報
     * 口コミ情報（文章はランダムです）
     * 店舗情報
   * PHPコンテナ内でシーディングを実行
   ```php
   php artisan db:seed
   ```

7. アップロードする画像を表示するため、シンボリックリンクを設定
   * PHPコンテナ内で以下のコマンドを実行
   ```php
   php artisan storage:link
   ```
   * PHPコンテナを終了
   ```php
   exit
   ```

8. トップページを開くには http://localhost へアクセスしてください
</details>