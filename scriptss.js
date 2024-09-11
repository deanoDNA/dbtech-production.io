document.addEventListener('DOMContentLoaded', () => {
    loadData('users');
    loadData('mechanics');
});

function loadData(entity) {
    fetch(`admin_data.php?entity=${entity}`)
        .then(response => response.json())
        .then(data => {
            const table = document.getElementById(`${entity}-table`).getElementsByTagName('tbody')[0];
            table.innerHTML = '';
            data.forEach(item => {
                const row = table.insertRow();
                row.insertCell(0).textContent = item.id;
                row.insertCell(1).textContent = item.name;
                row.insertCell(2).textContent = item.email;
                row.insertCell(3).textContent = item.contact;
                const actionsCell = row.insertCell(4);
                actionsCell.innerHTML = `
                    <button onclick="openForm('edit-${entity}', ${item.id}, '${item.name}', '${item.email}', '${item.contact}')">Edit</button>
                    <button onclick="deleteEntity('${entity}', ${item.id})">Delete</button>
                `;
            });
        })
        .catch(error => console.error('Error fetching data:', error));
}

function openForm(type, id = '', name = '', email = '', contact = '') {
    document.getElementById('form-container').style.display = 'block';
    document.getElementById('form-type').value = type;
    document.getElementById('entity-id').value = id;
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('contact').value = contact;
    document.getElementById('form-title').textContent = (type.includes('edit') ? 'Edit' : 'Add') + ` ${type.includes('user') ? 'User' : 'Mechanic'}`;
}

function closeForm() {
    document.getElementById('form-container').style.display = 'none';
}

document.getElementById('form').addEventListener('submit', (event) => {
    event.preventDefault();
    const formType = document.getElementById('form-type').value;
    const entity = formType.includes('user') ? 'users' : 'mechanics';
    const id = document.getElementById('entity-id').value;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const contact = document.getElementById('contact').value;

    fetch(`admin_action.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            type: formType,
            id: id,
            name: name,
            email: email,
            contact: contact,
            entity: entity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeForm();
            loadData(entity);
        } else {
            alert('An error occurred');
        }
    })
    .catch(error => console.error('Error:', error));
});

function deleteEntity(entity, id) {
    if (confirm('Are you sure you want to delete this record?')) {
        fetch(`admin_action.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                type: `delete-${entity}`,
                id: id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadData(entity);
            } else {
                alert('An error occurred');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
