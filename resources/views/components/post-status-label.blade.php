 @php
     if($post->status->id == 2) {
            $color = "cornflowerblue";
            $icon = "fas fa-hammer";
      }
      elseif($post->status->id == 3)  {
            $color = "limegreen";
            $icon = "fas fa-check";
      }
      elseif($post->status->id == 4) {
            $color = "red";
            $icon = "fas fa-times";
      } else {
        $color = "gray";
        $icon = "";
      }
 @endphp

 <span class="badge pill fs-6" style="border-color:unset; font-weight:normal; background:{{$color}}"> <i
         class="{{$icon}}"></i> {{$post->status->name}}</span>
