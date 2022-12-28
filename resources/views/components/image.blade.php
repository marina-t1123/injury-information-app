@php
    //assetメソッドで画像を表示する際に、type属性で怪我の画像かメディカル画像か判定してファイルのパスを変える
    if($type === 'injury_image'){ //怪我の画像の場合
        $path = 'storage/injury-image/';
        // 画像ファイルのパスを「storage>public>injury-imageディレクトリ」とする
    } elseif($type === 'medical_image') { //メディカル画像の場合
        $path = 'storage/medical-image/';
        // 画像ファイルのパスを「storage>public>medical-imageディレクトリ」とする
    }
@endphp
<div>
    <!-- 画像ファイルがない場合 -->
    @if(empty($imageFileName))
        <!-- No image画像を表示する -->
    	<img src="{{ asset('images/no_image.png')}}">
  	@else <!-- 画像ファイルが登録されている場合 -->
        <!-- 登録画像のパスを指定して画像を表示する -->
		<img src="{{ asset($path . $imageFileName ) }}">
    @endif
</div>

