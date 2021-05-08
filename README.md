# OTRP 更新情報
https://otrp-info.128-bit.net

# 概要
OTRPの更新情報を一覧表示するページ、APIです。
更新情報データはGoogleスプレッドシートで行っており、シートの内容変更時に連動してAPIデータが更新されます。

## 連動処理
1. シートを更新する
2. 更新時GASが発火、更新用データを作成し、連携API呼出
3. 連動APIでデータを更新

## API
### 更新情報一覧取得
https://otrp-info.128-bit.net/api/v1/update-info

更新情報、タグ一覧、最終更新日を含むデータを取得します。
