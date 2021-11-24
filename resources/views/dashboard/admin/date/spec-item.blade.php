<tr>
    <td> 
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
          </div>
          <input required name="specifications[{{ !empty($specification) ? $idx : 'IDX' }}][date]" value="{{ !empty($date) ? $date : (!empty($specification) ? $specification->key : '' )}}" type="text" id="date{{ !empty($specification) ? $idx : 'IDX' }}" class="form-control datee" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
          <?php $number=!empty($specification) ? $idx : 'IDX' ;  ?>
        </div>
    </div>
    </td>
    <td><button type="button" class="btn btn-xs btn-danger btn-remove-spec"><i class="fa fa-times"></i></button></td>
</tr>
