@foreach($salats as $salat)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{\App\Helpers\UserHelper::salatPerform($salat->$salatName)}}</td>
        <td>{{date('d-m-Y', strtotime($salat->created))}}</td>
        <td>
            <button value="{{$salat->id}}" class="salat-change-btn" > <i class="far fa-edit"></i></button>
        </td>
    </tr>
@endforeach