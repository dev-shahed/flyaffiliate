### v1.0.1 ( Nov 02, 2026 ) ###

- **update:** Rewrote the plugin page with a clearer description, the free and Pro feature lists, and new FAQ answers.

### v1.0.0 ( Oct 29, 2026 ) ###

- **new:** Affiliates, with email-only signup and a one-time activation link, an Affiliate user role, pending, active, inactive and suspended statuses, and an admin form with payment email, website, promotion method and an optional welcome email.
- **new:** Tracking, with a referral link per affiliate, a visit log with hashed visitor data, and a signed first-party cookie for the attribution window.
- **new:** Referral links, where affiliates generate a link to any page of your site from their dashboard and keep the ones they use, each with its visit count, which you also see on the affiliate's page.
- **new:** Commissions, with one commission per order item at checkout (classic and block), a product meta then default rate order capped at a maximum, optional shipping and tax exclusion, and self-referral blocked by default.
- **new:** Hold period, where every commission carries the date its hold ends, fixed when it is created, and a payout takes a commission only once that date has passed.
- **new:** Order sync, where commissions are pending at checkout and unpaid once the order is paid, failed, cancelled and (optionally) refunded orders reject them, a recovered order restores them, and a paid commission is never reversed.
- **new:** Hand-entered commissions with affiliate, amount, reference order (checked against WooCommerce), reference amount, origin, date, type and status.
- **new:** Payouts, with a preview grouped by payout method, one payment per affiliate, mark paid or unpaid, remove a commission, delete an unpaid payment and CSV export, and each payment keeps the address it was sent to.
- **new:** Payout methods, with Manual payouts to the affiliate's payment email and room for more methods, and affiliates choose how they are paid in their dashboard.
- **new:** WooCommerce Analytics, with an Affiliate Commission box on Analytics > Overview that counts the orders the report counts.
- **new:** A React admin with a dashboard and chart, affiliates, commissions, visits, payouts, settings and a setup wizard that opens on a first install only, with other plugins' notices kept off its screens.
- **new:** Extensions, a page that previews FlyAffiliate Pro's extensions while Pro is not active.
- **new:** Affiliate dashboard shortcode `[flyaffiliate_dashboard]` with the referral link and link generator, balance, commissions, visits, payouts and settings, and registration shortcode `[flyaffiliate_register]`.
- **new:** Usage data, with opt-in Appsero Insights that sends nothing until an administrator allows it (see Usage Data).
- **new:** REST API under `flyaffiliate/v1` for affiliates, commissions, visits, referral links, payouts, payout methods, settings and the affiliate's own data.
- **new:** WP-CLI command `wp flyaffiliate seed` for demo data.
