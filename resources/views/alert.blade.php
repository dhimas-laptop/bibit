 {{-- massage --}}
 @if (session('success'))
 <div id="alert" style="display: none">
   {{ session('success') }}
 </div>
    <script>
    var div = document.getElementById("alert");
    var myData = div.textContent;
    Swal.fire(
        'Berhasil!',
        myData,
        'success'
        )
    </script>
 @endif
 @if (session('error'))
 <div id="alert" style="display: none">
   {{ session('error') }}
 </div>
    <script>
    var div = document.getElementById("alert");
    var myData = div.textContent;
    Swal.fire(
        'Gagal!',
        myData,
        'error'
        )
    </script> 
 @endif
 @if (session('question'))
 <div id="alert" style="display: none">
   {{ session('question') }}
 </div>
    <script>
    var div = document.getElementById("alert");
    var myData = div.textContent;
    Swal.fire(
        'Yakin?',
        myData,
        'question'
        )
    </script> 
 @endif

 @if (count($errors) > 0) 
    <div id="alert" style="display: none">
        @foreach ($errors->all() as $error)
            {{$error}}<br/>
        @endforeach
    </div>
         <script>
         var div = document.getElementById("alert");
         var myData = div.textContent;
         Swal.fire(
             'Gagal!',
             myData,
             'error'
             )
         </script> 
 @endif
