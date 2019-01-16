<div class="col-md-11">
    <h2>Hadith</h2>
    <br><br>
    <table id="hadith-manage-table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <td><strong>SL.</strong></td>
            <td><strong>Hadith Description</strong></td>
            <td><strong>Source</strong></td>
            <td><strong>Posted By</strong></td>
            <td><strong>Posted at</strong></td>
            <td><strong>Status</strong></td>
            <td><strong>Action</strong></td>
            <td><strong>View</strong></td>
            <td><strong>Edit</strong></td>
            <td><strong>Delete</strong></td>
        </tr>
        </thead>
        <tbody>
        @foreach($hadiths as $hadith)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td width="250px">{{str_limit($hadith->description,40)}}</td>
                <td>{{$hadith->source}}</td>
                <td>{{$hadith->user->name}}</td>
                <td>{{$hadith->created_at->toFormattedDateString()}}</td>
                <td>

                    @if($hadith->status == "")
                    @elseif($hadith->status == "refuse")
                        Refused
                    @endif

                    @if($hadith->status == "approve")
                        Approved
                    @endif

                </td>
                <td>
                    <button class=" btn-success">Approve</button>
                    <button class=" btn-danger">Refuse</button>
                </td>
                <td><a class="delete" data-value="{{$hadith->id}}" href=""><i class="fa  fa-eye"></i></a></td>
                <td><a class="delete" data-value="{{$hadith->id}}" href=""><i class="fa fa-edit"></i></a></td>
                <td><a class="delete" data-value="{{$hadith->id}}" href=""><i class="fa fa-trash"></i></a></td>

            </tr>
        @endforeach

        </tbody>
    </table>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#hadith-manage-table").DataTable();
    });
</script>

