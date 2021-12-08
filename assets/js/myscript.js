// alert untuk mahasiswa
const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal.fire({
        title : 'Your Data',
        text: 'Has Been ' + flashData,
        icon: 'success'
    })
}

// jika tidak data mahasiswa 
const flash = $('.flash').data('flash');
if (flash) {
    Swal.fire({
        title : 'Data Mahasiswa',
        text: 'Not Found',
        icon: 'error'
    })
}

// untuk tombol hapus, jika dijalankan 
$('.tombol-hapus').on('click', function(e){
    e.preventDefault();
    // mencari href yang seddang dipencet
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Are you sure?',
        text: "Data will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    })
});