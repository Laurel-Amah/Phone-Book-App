function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0];

    if(file) {
        const reader = new FileReader();

        // Set up the event listener for when the file is read. 
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block'; // Show the image preview
        };

        reader.readAsDataURL(file); // Read the file as a Data URL (base64 encoded)
    } else {
        imagePreview.src = '';
        imagePreview.style.display = 'none'; // Hide the file preview if no file is selected.
    }
}