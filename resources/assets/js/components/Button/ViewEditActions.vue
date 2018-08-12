 <template>
    <div class="vieweditcustom-actions">
      <button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="ft-zoom-in">Detail</i></button>
      <button class="btn btn-sm" @click="itemAction('edit-item', rowData, rowIndex)"><i class="ft-edit">Edit</i></button>
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
      if(action === "view-item")
      {
               this.$root.$emit('viewitem', data , index);
      }
      else if(action === "edit-item")
      {
               this.$root.$emit('edititem', data , index);
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
    .vieweditcustom-actions button.ui.button {
      padding: 8px 8px;
    }
    .vieweditcustom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>