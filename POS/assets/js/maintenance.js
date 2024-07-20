document.getElementById('category-button').addEventListener('click', function() {
    document.getElementById('category-section').style.display = 'block';
    document.getElementById('unit-section').style.display = 'none';
    document.getElementById('discount-section').style.display = 'none';
    document.getElementById('tax-section').style.display = 'none';
    document.getElementById('save-section').style.display = 'none';
    document.getElementById('edit-section').style.display = 'block';
    
});

document.getElementById('unit-button').addEventListener('click', function() {
    document.getElementById('unit-section').style.display = 'block';
    document.getElementById('category-section').style.display = 'none';
    document.getElementById('discount-section').style.display = 'none';
    document.getElementById('tax-section').style.display = 'none';
    document.getElementById('save-section').style.display = 'none';
    document.getElementById('edit-section').style.display = 'block';
});

document.getElementById('discount-button').addEventListener('click', function() {
    document.getElementById('discount-section').style.display = 'block';
    document.getElementById('category-section').style.display = 'none';
    document.getElementById('unit-section').style.display = 'none';
    document.getElementById('tax-section').style.display = 'none';
    document.getElementById('save-section').style.display = 'none';
    document.getElementById('edit-section').style.display = 'block';
});

document.getElementById('tax-button').addEventListener('click', function() {
    document.getElementById('tax-section').style.display = 'block';
    document.getElementById('category-section').style.display = 'none';
    document.getElementById('discount-section').style.display = 'none';
    document.getElementById('unit-section').style.display = 'none';
    document.getElementById('save-section').style.display = 'none';
    document.getElementById('edit-section').style.display = 'block';
});

document.getElementById('edit').addEventListener('click', function() {
    document.getElementById('edit-section').style.display = 'none';
    document.getElementById('save-section').style.display = 'block';
});

document.getElementById('save').addEventListener('click', function() {
    document.getElementById('save-section').style.display = 'none';
    document.getElementById('edit-section').style.display = 'block';
});

