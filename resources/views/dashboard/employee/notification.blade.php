<?php $messages=0; ?>
@foreach ($message as $item)
  @if ($item->status !='seen')
      <?php $messages++; ?>
  @endif  
@endforeach
@if ($messages>0)
  <span class="right badge badge-danger">شما <?php echo $messages ; ?> پیام خوانده نشده دارید</span>   
@endif