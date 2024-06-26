@extends('admin.layout.app')

@section('content')

  <h1>Guest Index</h1>

  <button id="addButton">Add Guest Index</button>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>  
    <tbody id="guestTable">
    </tbody>
  </table>
  
  <div style="display: none;" id="editForm">
    <input type="text" id="editName"> 
    <button id="saveButton">Save</button>
  </div>

  <script>
    // Load data guest index
    async function loadData() {
      const response = await fetch("/guest/getAll");
      const guests = await response.json();

      // Render data ke table
      let tableRows = '';
      guests.forEach(guest => {
        tableRows += `
          <tr>
            <td>${guest.name}</td>
            <td>
              <button class="editButton" data-id="${guest.id}">Edit</button>
            </td>
          </tr>  
        `
      })

      document.getElementById('guestTable').innerHTML = tableRows;
    }

    // Fungsi untuk edit data
    async function editGuest(id) {
      // Show form edit
      document.getElementById('editForm').style.display = 'block'

      // Ambil data guest by ID
      const response = await fetch(`/guest/${id}`);
      const guest = await response.json();

      // Set value form
      document.getElementById('editName').value = guest.name;

      // Simpan perubahan
      document.getElementById('saveButton').onclick = async () => {
        const name = document.getElementById('editName').value;
        
        // Call API update
        const response = await fetch(`/guest/update/${id}`, {
          method: 'POST',
          body: JSON.stringify({name: name})
        });

        // Refresh ulang datatable
        loadData();

        // Hide form edit
        document.getElementById('editForm').style.display = 'none';
      }
    }

    // Tambah data baru
    document.getElementById('addButton').onclick = async () => {
      // Show form
      document.getElementById('editForm').style.display = 'block';
      
      // Clear value form  
      document.getElementById('editName').value = '';

      // Simpan data baru 
      document.getElementById('saveButton').onclick = async () => {
        const name = document.getElementById('editName').value;

        // Call API tambah data
        const response = await fetch("/guest/add", {
          method: 'POST',
          body: JSON.stringify({name: name})
        });

        // Refresh datatable
        loadData();

        // Hide form
        document.getElementById('editForm').style.display = 'none';
      }
    }

    // Load data saat halaman dimuat
    loadData();
  </script>

@endsection