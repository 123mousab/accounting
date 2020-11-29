<template>
    <div>
      <b-card>
      <b-table
      :items="items"
      :fields="fields"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      responsive="sm"
      sort-icon-left
       show-empty
      small
      stacked="md"
       :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
    ></b-table>

       <b-pagination
                v-model="currentPage"
                :total-rows="items.length"
                :per-page="perPage"
                aria-controls="my-table"
                align="right"
            ></b-pagination>
      </b-card>

    </div>
</template>

<script>
export default {
    data() {
        return {
          sortBy: 'id',
        sortDesc: false,
        fields: [
          { key: 'id', label:'ID', sortable: true },
          { key: 'country.name.ar', label:'Country', sortable: true },
          { key: 'name.ar', label:'Name', sortable: true },
          { key: 'status', label:'Status',  sortable: true }
        ],
        items: [],
         currentPage: 1,
        perPage: null,
        filter: null,
        };
    },
    mounted() {
         const requestSend = {
                resource: "area",
            };
            this.$store.dispatch("areas/getData", requestSend).then(res => {
                this.perPage  = res.data.meta.per_page;
                this.items = res.data.data;
            });
    }
};
</script>

<style></style>
