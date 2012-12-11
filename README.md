Magento Product Review
======================

Displaying magento product reviews on a tab in collateral-tabs

on layout call reviews on a tab like this

```xml
<block type="treview/reviews" name="treview_short_review" template="review/helper/summary_view.phtml">
	<action method="addToParentGroup"><group>detailed_info</group></action>
	<action method="setTitle" translate="value"><value>Reviews</value></action>
</block>
```

###visit: http://learntipsandtricks.com/ for more magento tips, tricks and codes.