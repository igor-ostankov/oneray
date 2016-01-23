import React from 'react';
import {Link} from 'react-router';

class Navbar extends React.Component {
	render() {
		return (
			<nav className="navbar navbar-default navbar-static-top">
				<div className="container">
					<div className="navbar-header">
						<a className="navbar-brand" href="#">OneRay</a>
					</div>

					<div className="collapse navbar-collapse">

						<ul className="nav navbar-nav navbar-right">
							<li className="dropdown">
								<a href="#" className="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{APPCONFIG.user.name}<span className="caret"></span></a>
								<ul className="dropdown-menu" role="menu">
									<li><Link to={'/logout'}>Выход</Link></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		)
	}
}

export default Navbar;