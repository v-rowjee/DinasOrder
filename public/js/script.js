$(".update-cart").change(function (e) {
    e.preventDefault();

    $.ajax({
        url: '{{ route("update.cart") }}',
        method: "patch",
        data: {
            _token: '{{ csrf_token() }}',
            id: $(this).attr("data-id"),
            quantity: $(this).val()
        },
        success: function (response) {
            window.location.reload();
        }
    });
});

$(".remove-from-cart").click(function (e) {
    e.preventDefault();

    $.ajax({
        url: '{{ route("remove.from.cart") }}',
        method: "DELETE",
        data: {
            _token: '{{ csrf_token() }}',
            id: $(this).attr("data-id")
        },
        success: function (response) {
            window.location.reload();
        }
    });
});
