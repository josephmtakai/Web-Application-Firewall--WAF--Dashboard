new Vue({
    el: '#app',
    data: {
        rules: [],
        newRuleName: '',
        newRuleDescription: '',
        newRuleAction: 'allow',
    },
    mounted() {
        this.fetchRules();
    },
    methods: {
        fetchRules() {
            fetch('http://your-backend-url/api.php?action=fetch_rules')
                .then(response => response.json())
                .then(data => {
                    this.rules = data;
                });
        },
        addRule() {
            const formData = new FormData();
            formData.append('action', 'add_rule');
            formData.append('rule_name', this.newRuleName);
            formData.append('rule_description', this.newRuleDescription);
            formData.append('action', this.newRuleAction);

            fetch('http://your-backend-url/api.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    this.fetchRules();
                    this.newRuleName = '';
                    this.newRuleDescription = '';
                }
            });
        },
    }
});
