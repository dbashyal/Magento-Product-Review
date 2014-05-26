Magento Product Review
======================

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=dbashyal&url=https://github.com/dbashyal&title=Github Repos&language=&tags=github&category=software)

Displaying magento product reviews on a tab in collateral-tabs

on layout call reviews on a tab like this

```xml
<block type="treview/reviews" name="treview_short_review" template="review/helper/summary_view.phtml">
	<action method="addToParentGroup"><group>detailed_info</group></action>
	<action method="setTitle" translate="value"><value>Reviews</value></action>
</block>
```

###visit: http://dltr.org/ for more magento tips, tricks and codes.
