@Props(["label"=>"", "placeholder"=>"", "col"=>""])
<div class="{{$col}}">
    <label for="inventory">{{ $label }}</label>
    <input type="text" class="form-control" placeholder="{{ $placeholder }}" value="" required>
</div>

