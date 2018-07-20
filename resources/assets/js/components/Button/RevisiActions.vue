 <template>
    <div class="revisi-custom-actions">
      <button class="btn btn-sm" @click="itemAction('revisi-item', rowData, rowIndex)"><i class="ft-check-square">REVISI</i></button>
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
      if(action === "revisi-item")
      {
               this.$root.$emit('viewitem', data , index);
			   
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
    .revisi-custom-actions button.ui.button {
      padding: 8px 8px;
    }
    .revisi-custom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>