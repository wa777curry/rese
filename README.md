# Rese（リーズ）　- 飲食店予約サービス

![top画像](https://github.com/wa777curry/rese/assets/136479019/6009072d-2dd7-4bc0-9f5b-a9b32f3a3155)

## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい

## ユーザーテストURL：http://localhost/
* テストアカウント：test@test  
* テストパスワード：11111111

## 管理者テストURL：http://localhost/admin/login/
* テストアカウント：admin@testmail  
* テストパスワード：admin123456

## 機能一覧
* 会員登録
* 店舗検索
* 予約の登録, 変更, 削除, 評価機能

## 使用技術
* HTML, CSS, JavaScript
* PHP 8.2.8, Laravel 8.83.27
* MySQL 15.1
* Docker, Docker Compose

## テーブル設計
![テーブル仕様書](https://github.com/wa777curry/rese/assets/136479019/195004aa-3a33-46d1-9b25-eb30edc779f7)

## ER図
![ER図](https://github.com/wa777curry/rese/assets/136479019/a4dcefb9-73ce-423c-993b-61cbab07ce44)

## 環境構築
1. DockerとDocker Composeをインストールしてください
2. githubからプロジェクトをクローンしてください
3. Dockerコンテナのビルドと起動が必要です
4. Laravelのパッケージをインストールしてください
5. .envファイルを作成してください
6. データベースのマイグレーションが必要です
7. シーダーファイルでダミーデータを呼び出せます
8. ブラウザで http://localhostにアクセスしてください
