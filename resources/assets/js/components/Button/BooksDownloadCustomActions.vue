 <template>
    <div class="custom-actions-download">
      <button class="btn btn-sm" @click="itemAction('download-item', rowData, rowIndex)"><i class="ft-download">Download</i></button> 
      <button class="btn btn-sm" @click="itemAction('edit-item', rowData, rowIndex)"><i class="ft-edit">Edit</i></button>
      <button class="btn btn-sm" @click="itemAction('delete-item', rowData, rowIndex)"><i class="ft-trash">Delete</i></button>
    </div>

  </template>

  <script>

  export default {
    props: {
      rowData: {
        type: Object,
        required: true
      },
      rowIndex: {
        type: Number
      }
    },
    methods: {
      itemAction (action, data, index) {
        if(action === "download-item")
      {
               this.$root.$emit('downloaditem', data , index);
      }
      else if(action === "edit-item")
      {
               this.$root.$emit('edititem', data , index);
      }
      else if(action === "delete-item")
      {
               this.$root.$emit('deleteitem', data , index);
      }
      else
      {
alert('error');
      }
        
      }
      }
      
    
  }
  </script>

  <style>
    .custom-actions-download button.ui.button {
      padding: 8px 8px;
    }
    .custom-actions-download button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>