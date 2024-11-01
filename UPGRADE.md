## Upgrade to realtimeregister/realtimeregister-php

If you're upgrading from an older version (or the original sandwave.io client), this file will help you:

### Breaking changes:

* We've removed DomainZoneServiceEnum because the functionality was also present in ZoneServiceEnum. If you use DomainZoneServiceEnum you should be able to use ZoneServiceEnum without any problems.
* We've changed the namespace, no other changes have been made, a simple search-and-replace should make your code compatible.

If you run into any other problems, please tell us and we'll do our best to help you.