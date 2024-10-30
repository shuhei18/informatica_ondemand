import csv
import json

# CSVファイルのパス
address_csv = 'path_to_address_csv.csv'
corporate_csv = 'path_to_corporate_csv.csv'

# 出力するJSONファイルのパス
output_json = 'zipcode_database.json'

# 郵便番号データを格納する辞書
zipcode_data = {}

# 一般の郵便番号のデータを読み込む
with open(address_csv, encoding='cp932') as csvfile:
    reader = csv.reader(csvfile)
    for row in reader:
        zipcode = row[2].replace("-", "")
        prefecture = row[6]
        city = row[7]
        town = row[8]
        zipcode_data[zipcode] = {
            "都道府県": prefecture,
            "市区町村": city,
            "町域": town
        }

# 個別番号のデータを読み込む
with open(corporate_csv, encoding='cp932') as csvfile:
    reader = csv.reader(csvfile)
    for row in reader:
        zipcode = row[7].replace("-", "")
        prefecture = row[3]
        city = row[4]
        town = row[5]
        if zipcode not in zipcode_data:
            zipcode_data[zipcode] = {
                "都道府県": prefecture,
                "市区町村": city,
                "町域": town
            }

# JSONファイルとして保存
with open(output_json, 'w', encoding='utf-8') as jsonfile:
    json.dump(zipcode_data, jsonfile, ensure_ascii=False, indent=2)

print(f'JSONファイルが {output_json} に保存されました。')
