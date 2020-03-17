
$('.custom-file-input').on('change', function () {
    let fileName = Array.from(this.files).map(x => x.name).join(', ')
    $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
});
