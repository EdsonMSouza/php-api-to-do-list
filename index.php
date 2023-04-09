<h1 id="php-api-to-do-list-v-2-0">PHP API TO-DO-LIST v.2.0</h1>
<p><code><img height="50" src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/php/php.png"></code>
    <code><img height="50" src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/mysql/mysql.png"></code></p>
<p>This API aims to present a brief to consume an API resources, mainly for students in the early years of Computer Science courses and the like. For this reason, it has few EndPoints (resources) to use, and can be expanded according to the need.</p>
<p>As it is an instructional project, <strong>it is not recommended</strong> that it be applied in a production environment, as safety routines and tests have not been implemented. These resources must be researched and implemented, following the current rules, in addition to good practices. Built in <strong>PHP 7</strong> (see below), it allows the beginner to understand the mechanisms of access to the resources of an API.</p>
<pre><code class="lang-html"><span class="hljs-selector-tag">PHP</span> 7<span class="hljs-selector-class">.4</span><span class="hljs-selector-class">.3</span> (<span class="hljs-selector-tag">cli</span>) (<span class="hljs-selector-tag">built</span>: <span class="hljs-selector-tag">Jul</span>  5 2021 15<span class="hljs-selector-pseudo">:13</span><span class="hljs-selector-pseudo">:35)</span> ( <span class="hljs-selector-tag">NTS</span> )
<span class="hljs-selector-tag">Copyright</span> (<span class="hljs-selector-tag">c</span>) <span class="hljs-selector-tag">The</span> <span class="hljs-selector-tag">PHP</span> <span class="hljs-selector-tag">Group</span> <span class="hljs-selector-tag">Zend</span> <span class="hljs-selector-tag">Engine</span> <span class="hljs-selector-tag">v3</span><span class="hljs-selector-class">.4</span><span class="hljs-selector-class">.0</span>,
<span class="hljs-selector-tag">Copyright</span> (<span class="hljs-selector-tag">c</span>) <span class="hljs-selector-tag">Zend</span> <span class="hljs-selector-tag">Technologies</span> <span class="hljs-selector-tag">with</span> <span class="hljs-selector-tag">Zend</span> <span class="hljs-selector-tag">OPcache</span> <span class="hljs-selector-tag">v7</span><span class="hljs-selector-class">.4</span><span class="hljs-selector-class">.3</span>,
<span class="hljs-selector-tag">Copyright</span> (<span class="hljs-selector-tag">c</span>), <span class="hljs-selector-tag">by</span> <span class="hljs-selector-tag">Zend</span> <span class="hljs-selector-tag">Technologies</span>
</code></pre>
<h2 id="how-to-use-this-content-">How to use this content?</h2>
<p>This content has <em>free license for use</em> (CC BY-SA 4.0).</p>
<p>If you want to collaborate in this repository with any improvements you have made. To do this, just make a Fork and send Pull Requests.</p>
<h2 id="composer">Composer</h2>
<p>Changes should be updated via <code>composer dump-autoload -o</code> on your local machine.</p>
<h2 id="todo">TODO</h2>
<ul>
    <li>Implement Update <code>username</code> and <code>password</code></li>
</ul>
<h1 id="documentation">Documentation</h1>
<p>This API provides functionality for creating and maintaining users to control a simple To-Do-List application. The
    following shows the API structure for <strong>users</strong> and <strong>tasks</strong> resources.</p>
<h2 id="api-structure">API Structure</h2>
<pre><code>+<span class="hljs-comment">---api</span>
    \<span class="hljs-keyword">task</span>\
        <span class="hljs-comment">---delete</span>
        <span class="hljs-comment">---edit</span>
        <span class="hljs-comment">---new</span>
        <span class="hljs-comment">---search</span>
        <span class="hljs-comment">---update</span>
    \user\
        <span class="hljs-comment">---new</span>
        <span class="hljs-comment">---login</span>
        <span class="hljs-comment">---update</span>
        <span class="hljs-comment">---delete</span>
+<span class="hljs-comment">---src</span>
    \<span class="hljs-comment">---Database</span>
    \<span class="hljs-comment">---Helpers</span>
    \<span class="hljs-comment">---Task</span>
    \<span class="hljs-comment">---User</span>
\<span class="hljs-comment">---vendor</span>
    \<span class="hljs-comment">---composer</span>
</code></pre><h2 id="_database_"><em>Database</em></h2>
<p>The development uses the MySQL 5, which can be changed at any time according to the need for use. The database should be
    configured in <code>Database\Database.php</code></p>
<h3 id="scripts-sql">Scripts SQL</h3>
<pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">DATABASE</span> <span class="hljs-keyword">name</span>;
</code></pre>
<pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> <span class="hljs-keyword">users</span>
(
    <span class="hljs-keyword">id</span>       <span class="hljs-built_in">INT</span>(<span class="hljs-number">3</span>)         <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span> PRIMARY <span class="hljs-keyword">KEY</span> AUTO_INCREMENT,
    <span class="hljs-keyword">name</span>     <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">50</span>)    <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>,
    email    <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">50</span>)    <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>,
    username <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">32</span>)    <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>,
    <span class="hljs-keyword">password</span> <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">32</span>)    <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>,
    token    <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">20</span>)    <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>,
    picture  <span class="hljs-built_in">TEXT</span>           <span class="hljs-keyword">DEFAULT</span> <span class="hljs-literal">NULL</span>
);
</code></pre>
<pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> tasks
(
    <span class="hljs-keyword">id</span>       <span class="hljs-built_in">INT</span>(<span class="hljs-number">3</span>)         <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span> PRIMARY <span class="hljs-keyword">KEY</span> AUTO_INCREMENT,
    userId   <span class="hljs-built_in">INT</span>(<span class="hljs-number">3</span>)         <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>,
    <span class="hljs-keyword">name</span>     <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">50</span>)    <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>,
    <span class="hljs-built_in">date</span>     <span class="hljs-built_in">date</span>           <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>,
    realized <span class="hljs-built_in">INT</span>(<span class="hljs-number">1</span>)         <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>
);
</code></pre>
<p>Attention: in order to delete corresponding tasks to user you need to do a <code>ALTER TABLE</code> adding a <code>FOREIGN KEY</code> and <code>ON DELETE CASCADE</code> option.</p>
<pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> tasks
<span class="hljs-keyword">ADD</span> <span class="hljs-keyword">CONSTRAINT</span> pk_user
FOREIGN <span class="hljs-keyword">KEY</span> (userId)
<span class="hljs-keyword">REFERENCES</span> <span class="hljs-keyword">users</span>(<span class="hljs-keyword">id</span>)
<span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">CASCADE</span>;
</code></pre>
<h2 id="token">Token</h2>
<p>To use this API, a user must first be created with resource below.</p>
<p>A TOKEN will be returned that should be used in all subsequent requests for both user and task data manipulation.</p>
<h2 id="uri">URI</h2>
<p>The <code>URI</code> variable must be filled with the address where the API will be made available.</p>
<h1 id="_resources_"><em>Resources</em></h1>
<h2 id="user">User</h2>
<table>
    <thead>
    <tr>
        <th style="text-align:center">Resource</th>
        <th style="text-align:center">URI</th>
        <th style="text-align:center">Method</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center"><strong>NEW</strong></td>
        <td style="text-align:center"><code>http://URI/api/user/new/</code></td>
        <td style="text-align:center"><strong>POST</strong></td>
    </tr>
    </tbody>
</table>
<hr>
<p><em><strong>payload</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"name"</span>: <span class="hljs-string">"name"</span>,
  <span class="hljs-attr">"email"</span>: <span class="hljs-string">"email"</span>,
  <span class="hljs-attr">"username"</span>: <span class="hljs-string">"username"</span>,
  <span class="hljs-attr">"password"</span>: <span class="hljs-string">"password"</span>
}
</code></pre>
<p><em><strong>header</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"content-type"</span>: <span class="hljs-string">"application/json"</span>
}
</code></pre>
<p><em><strong>Success</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"User Successfully Added"</span>,
  <span class="hljs-attr">"id"</span>: <span class="hljs-string">"user_id"</span>,
  <span class="hljs-attr">"token"</span>: <span class="hljs-string">"TOKEN value"</span>
}
</code></pre>
<p><em><strong>Warnings</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Invalid Arguments Number (Expected Four)"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Could Not Add User"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"User Already Exists"</span>
}
</code></pre>
<hr>
<table>
    <thead>
    <tr>
        <th style="text-align:center">Resource</th>
        <th style="text-align:center">URI</th>
        <th style="text-align:center">Method</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center"><strong>LOGIN</strong></td>
        <td style="text-align:center"><code>http://URI/api/user/login/</code></td>
        <td style="text-align:center"><strong>POST</strong></td>
    </tr>
    </tbody>
</table>
<p><em><strong>payload</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"username"</span>: <span class="hljs-string">"username"</span>,
  <span class="hljs-attr">"password"</span>: <span class="hljs-string">"password"</span>
}
</code></pre>
<p><em><strong>header</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"content-type"</span>: <span class="hljs-string">"application/json"</span>
}
</code></pre>
<p><em><strong>Success</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"id"</span>: <span class="hljs-number">1</span>,
  <span class="hljs-attr">"name"</span>: <span class="hljs-string">"John Doe"</span>,
  <span class="hljs-attr">"email"</span>: <span class="hljs-string">"john.doe@domain.com"</span>,
  <span class="hljs-attr">"token"</span>: <span class="hljs-string">"YOUR_TOKEN"</span>,
  <span class="hljs-attr">"picture"</span>: <span class="hljs-string">"BASE64_STRING"</span>
}
</code></pre>
<p><em><strong>Warnings</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Invalid Arguments Number (Expected Two)"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Incorrect username and/or password"</span>
}
</code></pre>
<hr>
<table>
    <thead>
    <tr>
        <th style="text-align:center">Resource</th>
        <th style="text-align:center">URI</th>
        <th style="text-align:center">Method</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center"><strong>UPDATE</strong></td>
        <td style="text-align:center"><code>http://URI/api/user/update/</code></td>
        <td style="text-align:center"><strong>PUT</strong></td>
    </tr>
    </tbody>
</table>
<p>Attention: <code>username</code> and <code>password</code> can not be changed in this version.</p>
<p><em><strong>payload</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"name"</span>: <span class="hljs-string">"name"</span>,
  <span class="hljs-attr">"email"</span>: <span class="hljs-string">"email"</span>,
  <span class="hljs-attr">"username"</span>: <span class="hljs-string">"username"</span>,
  <span class="hljs-attr">"password"</span>: <span class="hljs-string">"password"</span>,
  <span class="hljs-attr">"picture"</span>: <span class="hljs-string">"picture"</span>
}
</code></pre>
<p><em><strong>header</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"content-type"</span>: <span class="hljs-string">"application/json"</span>,
  <span class="hljs-attr">"Authorization"</span>: <span class="hljs-string">"YOUR_TOKEN"</span>
}
</code></pre>
<p><em><strong>Success</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"User Successfully Updated"</span>
}
</code></pre>
<p><em><strong>Warnings</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Invalid Arguments Number (Expected Five)"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Incorrect username and/or password"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Could Not Update User"</span>
}
</code></pre>
<hr>
<table>
    <thead>
    <tr>
        <th style="text-align:center">Resource</th>
        <th style="text-align:center">URI</th>
        <th style="text-align:center">Method</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center"><strong>DELETE</strong></td>
        <td style="text-align:center"><code>http://URI/api/user/delete/</code></td>
        <td style="text-align:center"><strong>DELETE</strong></td>
    </tr>
    </tbody>
</table>
<p><em><strong>payload</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"username"</span>: <span class="hljs-string">"username"</span>,
  <span class="hljs-attr">"password"</span>: <span class="hljs-string">"password"</span>,
}
</code></pre>
<p><em><strong>header</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"content-type"</span>: <span class="hljs-string">"application/json"</span>,
  <span class="hljs-attr">"Authorization"</span>: <span class="hljs-string">"YOUR_TOKEN"</span>
}
</code></pre>
<p><em><strong>Success</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"User Successfully Deleted"</span>
}
</code></pre>
<p><em><strong>Warnings</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Invalid Arguments Number (Expected Two)"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Incorrect username and/or password"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Could Not Delete User"</span>
}
</code></pre>
<hr>
<h1 id="task">Task</h1>
<table>
    <thead>
    <tr>
        <th style="text-align:center">Resource</th>
        <th style="text-align:center">URI</th>
        <th style="text-align:center">Method</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center"><strong>NEW</strong></td>
        <td style="text-align:center"><code>http://URI/api/task/new/</code></td>
        <td style="text-align:center"><strong>POST</strong></td>
    </tr>
    </tbody>
</table>
<hr>
<p><em><strong>payload</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"name"</span>: <span class="hljs-string">"Task name"</span>
}
</code></pre>
<p><em><strong>header</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"content-type"</span>: <span class="hljs-string">"application/json"</span>,
  <span class="hljs-attr">"Authorization"</span>: <span class="hljs-string">"YOUR_TOKEN"</span>
}
</code></pre>
<p><em><strong>Success</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Task Successfully Added"</span>
}
</code></pre>
<p><em><strong>Warnings</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Invalid Arguments Number (Expected Two)"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Could Not Add Task"</span>
}
</code></pre>
<table>
    <thead>
    <tr>
        <th style="text-align:center">Resource</th>
        <th style="text-align:center">URI</th>
        <th style="text-align:center">Method</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center"><strong>SEARCH</strong></td>
        <td style="text-align:center"><code>http://URI//api/task/search/</code></td>
        <td style="text-align:center"><strong>POST</strong></td>
    </tr>
    </tbody>
</table>
<hr>
<p>Payload is not necessary, as the control is performed by <code>token</code>.</p>
<p><strong>Realized</strong> field accept values: <code>0</code> (open) or <code>1</code> (realized)</p>
<p><em><strong>header</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"content-type"</span>: <span class="hljs-string">"application/json"</span>,
  <span class="hljs-attr">"Authorization"</span>: <span class="hljs-string">"YOUR_TOKEN"</span>
}
</code></pre>
<p><em><strong>Success</strong></em></p>
<pre><code class="lang-json">[
  {
    <span class="hljs-attr">"id"</span>: <span class="hljs-number">1</span>,
    <span class="hljs-attr">"userId"</span>: <span class="hljs-number">1</span>,
    <span class="hljs-attr">"name"</span>: <span class="hljs-string">"task name"</span>,
    <span class="hljs-attr">"date"</span>: <span class="hljs-string">"2021-08-16"</span>,
    <span class="hljs-attr">"realized"</span>: <span class="hljs-number">0</span>
  }
]
</code></pre>
<table>
    <thead>
    <tr>
        <th style="text-align:center">Resource</th>
        <th style="text-align:center">URI</th>
        <th style="text-align:center">Method</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center"><strong>UPDATE</strong></td>
        <td style="text-align:center"><code>http://URI/api/task/update/</code></td>
        <td style="text-align:center"><strong>PUT</strong></td>
    </tr>
    </tbody>
</table>
<hr>
<p><em><strong>payload</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"id"</span>: <span class="hljs-string">"value"</span>,
  <span class="hljs-attr">"name"</span>: <span class="hljs-string">"Task name"</span>,
  <span class="hljs-attr">"realized"</span>: <span class="hljs-string">"value"</span>
}
</code></pre>
<p><em><strong>header</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"content-type"</span>: <span class="hljs-string">"application/json"</span>,
  <span class="hljs-attr">"Authorization"</span>: <span class="hljs-string">"YOUR_TOKEN"</span>
}
</code></pre>
<p><em><strong>Success</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Task Successfully Updated"</span>
}
</code></pre>
<p><em><strong>Warnings</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Task(s) not found"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Method Not Allowed"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Invalid Arguments Number (Expected Three)"</span>
}
</code></pre>
<table>
    <thead>
    <tr>
        <th style="text-align:center">Resource</th>
        <th style="text-align:center">URI</th>
        <th style="text-align:center">Method</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center"><strong>EDIT</strong></td>
        <td style="text-align:center"><code>http://URI/api/task/edit/</code></td>
        <td style="text-align:center"><strong>POST</strong></td>
    </tr>
    </tbody>
</table>
<hr>
<p><em><strong>payload</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"id"</span>: <span class="hljs-string">"value"</span>
}
</code></pre>
<p><em><strong>header</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"content-type"</span>: <span class="hljs-string">"application/json"</span>,
  <span class="hljs-attr">"Authorization"</span>: <span class="hljs-string">"YOUR_TOKEN"</span>
}
</code></pre>
<p><em><strong>Success</strong></em></p>
<pre><code class="lang-json">{
<span class="hljs-attr">"id"</span>: <span class="hljs-number">2</span>,
<span class="hljs-attr">"userId"</span>: <span class="hljs-number">1</span>,
<span class="hljs-attr">"name"</span>: <span class="hljs-string">"Task name"</span>,
<span class="hljs-attr">"date"</span>: <span class="hljs-string">"2021-08-16"</span>,
<span class="hljs-attr">"realized"</span>: <span class="hljs-number">0</span>
}
</code></pre>
<p><em><strong>Warnings</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Payload Precondition Failed"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Invalid or Missing Token"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Invalid Arguments Number (Expected One)"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Bad Request (Invalid Syntax)"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Token Refused"</span>
}
</code></pre>
<table>
    <thead>
    <tr>
        <th style="text-align:center">Resource</th>
        <th style="text-align:center">URI</th>
        <th style="text-align:center">Method</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align:center"><strong>DELETE</strong></td>
        <td style="text-align:center"><code>http://URI/api/task/delete/</code></td>
        <td style="text-align:center"><strong>DELETE</strong></td>
    </tr>
    </tbody>
</table>
<hr>
<p><em><strong>payload</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"id"</span>: <span class="hljs-string">"id_task"</span>
}
</code></pre>
<p><em><strong>header</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"content-type"</span>: <span class="hljs-string">"application/json"</span>,
  <span class="hljs-attr">"Authorization"</span>: <span class="hljs-string">"YOUR_TOKEN"</span>
}
</code></pre>
<p><em><strong>Success</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Task deleted Successfully"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Task not exist"</span>
}
</code></pre>
<hr>
<p><em><strong>Other Warnings</strong></em></p>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Bad Request (Invalid Syntax)"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Token Refused"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Invalid or Missing Token"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Payload Precondition Failed"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"Method Not Allowed"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"&lt;SQL Code&gt;"</span>
}
</code></pre>
<pre><code class="lang-json">{
  <span class="hljs-attr">"message"</span>: <span class="hljs-string">"&lt;Unknown&gt;"</span>
}
</code></pre>
<hr>
<p><a name="tryonline"></a></p>
<h2 id="try-online">Try Online</h2>
<p>You can try online this API with full features.</p>
<ul>
    <li>URI: <a href="https://todolist-api.edsonmelo.com.br/">https://todolist-api.edsonmelo.com.br/</a></li>
</ul>
<hr>
<h2 id="flutter-app-todolist">Flutter APP ToDoList</h2>
<p>You can test the API functionalities by accessing <a href="https://github.com/Wilian-N-Silva/flutter_to_do_list">here</a> the APP developed by <a href="https://github.com/Wilian-N-Silva">Wilian Silva</a>.</p>
<h3 id="views">Views</h3>
<p><img src="images/telas.png" alt="Alt text" title="APP Views"></p>
<hr>
<h2 id="how-to-cite-this-content">How to cite this content</h2>
<pre><code>DE SOUZA, Edson Melo (2021, August 16). PHP API TO-<span class="hljs-keyword">DO</span>-<span class="hljs-keyword">LIST</span> v<span class="hljs-number">.2</span><span class="hljs-number">.0</span>.
Available <span class="hljs-keyword">in</span>: https://github.com/EdsonMSouza/php-api-<span class="hljs-keyword">to</span>-<span class="hljs-keyword">do</span>-<span class="hljs-keyword">list</span>
</code></pre><p>Or BibTeX for LaTeX:</p>
<pre><code class="lang-latex">@misc{desouza2020phpapi,
  author = {DE SOUZA, Edson Melo},
  title = {PHP API TO-DO-LIST v.<span class="hljs-number">2.0</span>},
  url = {https://github.com/EdsonMSouza/php-api-to-do-list},
  year = {<span class="hljs-number">2021</span>},
  month = {August}
}
</code></pre>
<h2 id="acknowledgements">Acknowledgements</h2>
<ul>
    <li><p><a href="https://github.com/arthur-timoteo">Arthur Timoteo</a></p>
    </li>
    <li><p><a href="https://github.com/Wilian-N-Silva">Wilian Silva</a></p>
    </li>
</ul>
<h2 id="license">License</h2>
<p><a href="http://creativecommons.org/licenses/by-sa/4.0/"><img src="https://img.shields.io/badge/License-CC%20BY--SA%204.0-lightgrey.svg" alt="CC BY-SA 4.0"></a></p>
<p>This work is licensed under a
    <a href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.</p>
<p><a href="http://creativecommons.org/licenses/by-sa/4.0/"><img src="https://licensebuttons.net/l/by-sa/4.0/88x31.png" alt="CC BY-SA 4.0"></a></p>
