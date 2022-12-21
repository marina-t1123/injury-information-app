<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Storageディレクトリでの画像アップロード処理(1枚の場合)
     *
     * @param [type] $imageFile
     * @param string $folderName
     * @var string $imageFileNewName
     */
    public static function upload($imageFile, $folderName){

        //画像のファイル名を重複しないIDをファイル名に指定して生成する
        $fileName = uniqid(rand().'_');
        //画像ファイルの拡張子を取得する
        $extension = $imageFile->extension();
        //画像ファイル名と画像ファイルの拡張子を繋げて、新しく作成した画像ファイル名を変数に格納する
        $imageFileNewName = $fileName.'.'.$extension;

        // storage > app > public > injury-imageディレクトリ配下に先ほど作成した画像ファイル名で画像ファイルを保村する。
        // 第一引数：storage/appディレクトリ配下に画像を登録するためのディレクトリを指定
        // 第二引数：登録したい画像ファイル(ファイルインスタンス)の指定
        // 第三引数：画像ファイル名を指定(今回は、一意のファイル名を作成して指定)
        Storage::putFileAs('public/'.$folderName.'/', $imageFile, $imageFileNewName);

        // storageに登録した画像ファイルを返り値として返す
        return $imageFileNewName;
    }

    public static function destroy($imageFileName, $folderName)
    {
        // 変更前のStorage配下の$folderNameで指定しているディレクトリ配下に登録した画像を削除する
        Storage::disk('public')->delete('/'.$folderName.'/'.$imageFileName);
        //変更前のStorage配下のinjury-imageディレクトリに登録した画像を削除する
        // Storage::disk('public')->delete('/injury-image/'.$registerInjuryImageFile);
    }
}
