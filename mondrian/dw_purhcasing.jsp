<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>


<jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver" 
jdbcUrl="jdbc:mysql://localhost:3307/adventureworksdw2023?user=root&password=" catalogUri="/WEB-INF/queries/dw_purchasing.xml">

select [Measures].[Purchasing Cost] ON COLUMNS,
  {([Time].[All Times],[Product].[All Products],[Vendor].[All Vendors],[Shipping].[All Shipping])} ON ROWS
from [Purchasing]


</jp:mondrianQuery>





<c:set var="title01" scope="session">Query DWO Purchasing using Mondrian OLAP</c:set>
