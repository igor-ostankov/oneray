import React from 'react';
import { render } from 'react-dom';
import { Router, Route, Link } from 'react-router';
import createBrowserHistory from 'history/lib/createBrowserHistory';
import Navbar from './components/Navbar';
import Home from './views/Home';

class App extends React.Component {
	render() {
		return (
			<div>
				<Navbar />
				{this.props.children}
			</div>
		);
	}
}
render((
	<Router history={createBrowserHistory()}>
		<Route path="/" component={App}>
			<Route path="home" component={Home} />
		</Route>
	</Router>
), document.getElementById('app'));

