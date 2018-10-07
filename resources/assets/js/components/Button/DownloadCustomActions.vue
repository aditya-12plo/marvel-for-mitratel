 <template>
    <div class="custom-download">
      <button class="btn btn-sm" @click="itemAction('download-item', rowData, rowIndex)"><i class="ft-download">Download</i></button>
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
      else
      {
alert('error');
      }
        
      }
      }
      
    
  }
  </script>

  <style>
    .custom-download button.ui.button {
      padding: 8px 8px;
    }
    .custom-download button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>