<div class="navbar-right-content show-nav-content">
    <div class="single-right-content">
        <div class="navbar-right-flex">
            @if(moduleExists('CurrencySwitcher'))
                <x-frontend.menu-currency />
            @endif
            <div class="navbar-right-item position-relative">
                <a href="#0" class="navbar-right-chat search-header-open">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
                <div class="header-global-search">
                    <div class="header-global-search-header">
                        <h5 class="header-global-search-title">Ara</h5>
                        <div class="header-global-search-close search-close"><i class="fa-solid fa-times"></i>
                        </div>
                    </div>
                    <div class="header-global-search-input d-flex align-items-center">
                        <div class="header-global-search-input-inner">
                            <div class="header-global-search-input-inner-icon" id="header_search_load_spinner">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <input type="text" id="search_your_desired_job" class="form-control" placeholder="Hizmet, ilan veya usta ara..." autocomplete="off">
                            <div class="header-global-search-select">
                                <select id="Select_project_or_job_for_search">
                                    @if(get_static_option('project_enable_disable') != 'disable')
                                        <option value="project">Hizmet</option>
                                    @endif
                                    @if(get_static_option('job_enable_disable') != 'disable')
                                        <option value="job">İlan</option>
                                    @endif
                                    <option value="talent">Usta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="display_search_result"></div>
                </div>
                <div class="search-overlay"></div>
            </div>
            <div class="navbar-right-btn" style="display: flex; align-items: center; gap: 10px;">
                @if(moduleExists('Community'))
                <a href="{{ route('community.all') }}"
                   style="padding: 8px 20px; border: 2px solid #FA8C00; color: #FA8C00; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.3s ease;"
                   onmouseover="this.style.backgroundColor='#FA8C00'; this.style.color='white';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='#FA8C00';">Topluluk
                </a>
                @endif
                <a href="{{ route('user.login') }}"
                   style="padding: 8px 24px; border: 2px solid #FA8C00; color: #FA8C00; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.3s ease;"
                   onmouseover="this.style.backgroundColor='#FA8C00'; this.style.color='white';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='#FA8C00';">Giriş Yap
                </a>
                <a href="{{ route('user.register') }}"
                   style="padding: 8px 24px; background-color: #FA8C00; color: white; border: 2px solid #FA8C00; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.3s ease;"
                   onmouseover="this.style.backgroundColor='#E67E00'; this.style.borderColor='#E67E00';"
                   onmouseout="this.style.backgroundColor='#FA8C00'; this.style.borderColor='#FA8C00';">Kayıt Ol
                </a>
            </div>
        </div>
    </div>
</div>