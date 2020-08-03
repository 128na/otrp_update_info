/**
 * OTRP更新履歴API
 */


/**
 * シートデータの抽出
 */
function getData(sheetName) {
  var sheet = SpreadsheetApp.getActive().getSheetByName(sheetName);
  var rows = sheet.getDataRange().getValues();
  var keys = rows.splice(0, 1)[0];

  return rows.map(function (row) {
    var obj = {};
    row.map(function (item, index) {
      obj[String(keys[index])] = item;
    });
    return obj;
  });
}

/**
 * データ加工
 * リレーション情報をIDに置換、タグのグルーピング
 */
function treatInfo(data) {
  data.update_info = data.update_info.map(function (i) {
    return {
      id: i.id,
      content: i.content,
      version: findIdBy(data.versions, 'version', i.version),
      tags: [
        findIdBy(data.tags, 'name', i.tag1),
        findIdBy(data.tags, 'name', i.tag2),
        findIdBy(data.tags, 'name', i.tag3),
      ].filter(function (i) { return i; }),
    };
  })

  data.versions = data.versions.sort(function (a, b) { return a.released_at < b.released_at ? 1 : -1 });

  return data;
}

/**
 * 配列からkeyがvalueにマッチするレコードのidを返す
 */
function findIdBy(arr, key, value) {
  var res = arr.filter(function (i) {
    return i[key] == value;
  });
  return res.length ? res.shift().id : null;
}

function buildData() {
  var data = {
    versions: getData('Versions'),
    tags: getData('Tags'),
    update_info: getData('UpdateInfo'),
  };

  return JSON.stringify(treatInfo(data), null, 2);
}

/**
 * エントリポイント
 */
function doGet() {
  var data = buildData();

  return ContentService.createTextOutput(data)
    .setMimeType(ContentService.MimeType.JSON);
}

function sendDataOnChange() {
  var options = {
    method: 'post',
    payload: {
      token: 'xxxxxx',
      data: buildData(),
    },
    muteHttpExceptions: false,
  };

  var url = 'http://simutrans.sakura.ne.jp/otrp_update_info/api/receiver';

  UrlFetchApp.fetch(url, options);
}
