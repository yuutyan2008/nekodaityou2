#!/bin/bash

# バケット名とサイズを保存する配列
bucket_sizes=()

# すべてのバケットを取得
buckets=$(aws s3api list-buckets --query "Buckets[].Name" --output text)

# バケットごとにサイズを計算
for bucket in $buckets; do
  # "cloudtrail"で始まるバケットはスキップ
  if [[ $bucket == cloudtrail* ]]; then
    continue
  fi

  # バケットの全オブジェクトのサイズを合計 (MB単位に変換)
  size=$(aws s3api list-objects-v2 --bucket $bucket --query "sum(Contents[].Size)" --output text)
  
  # サイズが空の場合、ゼロに設定
  if [ -z "$size" ] || [ "$size" == "None" ]; then
    size=0
  fi

  # サイズをMBに変換 (浮動小数点数で計算)
  size_mb=$(echo "$size / 1024 / 1024" | bc -l)

  # 配列にバケット名とサイズを保存
  bucket_sizes+=("$bucket, $size_mb MB")
done

# サイズを大きい順に並べ替えて出力
for entry in "${bucket_sizes[@]}" | sort -t, -k2 -nr; do
  echo "$entry"
done

