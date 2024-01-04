<div class="content-wrapper">


<div class="shadow-sm p-3 mb-5 bg-white rounded">
<br>
<h3 class="text-2xl font-semibold">Send Message</h3>
<br>
<p class="text-warning">The sender-id is the name which will be appearing when you send an SMS to your client. This name should be short and brief with a minimum of 4 characters and maximum of 12 characters. Please send us an email at info@swift-sms.net to let us know your prefered sender id and we will create one for you ASAP. You can't send any text without a <strong>sender-id</strong> .</p>
<br>
<form action="{{ route('message.store') }}" method="POST">
    @csrf
    <div id="name-inputs">
        <div class="input-group mb-3">
            <input type="number" name="numbers[]" class="form-control @error('numbers') is-invalid @enderror" placeholder="Enter number" required>
            @error('numbers')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
            <button type="" class="btn btn-success add-more"><i class="fas fa-plus-circle"></i></button>
        </div>
    </div>

    <div class="form-group">
    <label for="comment">Comment:</label>
    <textarea class="form-control @error('message') is-invalid @enderror" id="comment" name="message" maxlength="160" rows="5" placeholder="Enter your message in not more than 160 characters" oninput="updateCharacterCount()"></textarea>
    <span id="characterCount">160</span> characters remaining

    @error('message')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


    <button type="" class="btn btn-primary">Send Message</button>
</form>

</div>



<script>
$(document).ready(function(){
    $(".add-more").click(function(){
        var html = '<div class="input-group mb-3"><input type="number" name="numbers[]" class="form-control" required><button type="" class="btn btn-danger remove"><i class="fas fa-minus"></i></button></div>';
        $("#name-inputs").append(html);
    });

    $(document).on("click", ".remove", function(){
        $(this).parent().remove();
    });
});
</script>

<script>
function updateCharacterCount() {
    // Get the textarea element and the character count span element
    var textarea = document.getElementById("comment");
    var characterCount = document.getElementById("characterCount");

    // Get the current character count
    var currentCount = textarea.value.length;

    // Calculate the remaining characters
    var remainingCount = textarea.maxLength - currentCount;

    // Update the character count span
    characterCount.textContent = remainingCount;
}
</script>

</div>