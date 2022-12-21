<div>
    @if(empty($medicalQuestionnaire->injury_image))
    	<img src="{{ asset('images/no_image.png')}}">
  	@else
		<img src="{{ asset('storage/injury-image/' . $medicalQuestionnaire->injury_image ) }}">
    @endif
</div>
