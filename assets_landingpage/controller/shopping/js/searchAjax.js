
$(document).ready(function () {
    $("#searchInput").keyup(function () {
        var query = $(this).val();
        if (query !== "") {
            $.ajax({
                url: "controller/shopping/get_suggestions.php", // Replace with the actual PHP script to fetch suggestions
                method: "POST",
                data: { query: query },
                success: function (data) {
                    $("#suggestionsContainer").html(data);
                },
            });
        } else {
            $("#suggestionsContainer").empty();
        }
    });
});

